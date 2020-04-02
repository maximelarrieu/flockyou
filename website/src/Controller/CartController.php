<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Cart;
use App\Entity\Command;
use App\Entity\CommandProduct;
use App\Entity\Livraison;
use App\Form\CommandType;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     * @param Cart $cart
     * @param Bank|null $bank
     * @param Livraison|null $livraison
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function index(Cart $cart, Bank $bank = null, Livraison $livraison = null, Request $request, ObjectManager $manager, \Swift_Mailer $mailer)
    {
        $user = $this->getUser();
        $total = 0;

        foreach ($user->getCart()->getCartproduct() as $product) {
            $total += $product->getProduct()->getPrice() * $product->getQuantity();
        }

        $commandProducts = new CommandProduct();
        $command = new Command();

        $form = $this->createForm(CommandType::class, $commandProducts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getBudget() > $total) {
                foreach ($user->getCartProducts() as $product) {
//                $command->setUser($user);
                    $commandProducts->setCommand($command);
                    $commandProducts->addCartProduct($product);
                    $command->setNbCommand(rand(2000, 8000));
                    $command->setCreatedAt(new \DateTime());
                    $command->setUser($user);
                    $command->setTotal($total);
                    $product->getProduct()->setQuantity($product->getProduct()->getQuantity() - $product->getQuantity());
                }
                $user->setBudget($user->getBudget() - $total);

//                $pdfOptions = new Options();
//                $pdfOptions->set('defaultFont', 'Arial');
//
//                $dompdf = new Dompdf($pdfOptions);
//
//                $html = $this->render('pdf/command.html.twig', [
//                    'name' => $user->getUsername()
//                ]);
//                $dompdf->loadHtml($html->getContent());
//                $dompdf->setPaper('A4', 'portrait');
//                $dompdf->render();
//                $dompdf->stream("command.pdf", [
//                    'Attachment' => false
//                ]);
                $logo = \Swift_Image::fromPath('assets/images/ressources/flockyou.png');
                $mail = (new \Swift_Message("Merci pour votre commande !"))
                    ->setFrom('flockyou@support.store')
                    ->setTo($user->getEmail());

                $mail->setBody(
                    $this->renderView(
                        'mails/command.html.twig',
                        ['name' => $user->getUsername(),
                        'logo' => $logo ]
                    ),
                    'text/html'
                )
//                 ->attach(\Swift_Attachment::fromPath($dompdf));
                ;
                $mailer->send($mail);

                $newCart = new Cart();
                $user->setCart($newCart);

                $manager->persist($commandProducts);
                $manager->persist($command);
                $manager->flush();

                return $this->redirectToRoute('account', [
                    'username' => $this->getUser()->getUsername()
                ]);
            } else {
                $this->addFlash(
                    'warning',
                    'Désolé, votre solde est insuffisant..'
                );

                return $this->render('cart/index.html.twig', [
                    'bank' => $bank,
                    'livraison' => $livraison,
                    'cart' => $cart,
                    'user' => $user,
                    'total' => $total,
                    'form' => $form->createView()
                ]);
            }
        }

        return $this->render('cart/index.html.twig', [
            'bank' => $bank,
            'livraison' => $livraison,
            'cart' => $cart,
            'user' => $user,
            'total' => $total,
            'form' => $form->createView()
        ]);
    }
}
