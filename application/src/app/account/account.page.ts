import { Component } from '@angular/core';
import { AccountService, Livraison } from './account.service';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from '../auth.service';

@Component({
  selector: 'app-account',
  templateUrl: './account.page.html',
  styleUrls: ['./account.page.scss'],
})
export class AccountPage {

  // Initialisation du tableau d'objet que l'on souhaite récupérer
  public livraisons: Livraison[];

  constructor(private authService: AuthService, private route: ActivatedRoute, private router: Router, private livraisonService: AccountService, private data: AccountService) {}

  // Fonction appelant la fonction de suppression dans le LivraisonService
  deleteLivraison(livraison: Livraison): void {
    this.livraisonService.deletedLivraison(this.livraisons)
  }

  // Fonction redirigeant vers le formulaire de création/edition de livraison
  goEdit(livraison: Livraison): void {
    let link = ['livraison/edit'];
    this.router.navigate(link);
  }

  ngOnInit() {
    // Initialisation de la page avec la fonction récupération du service & assignation d'une variable aux éléments
    this.data.getLivraisons().subscribe(
      livraisons => this.livraisons = livraisons
    );
  }
}
