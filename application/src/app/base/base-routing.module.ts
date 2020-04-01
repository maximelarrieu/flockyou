import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BasePage } from './base.page';

//@ts-ignore
const routes: Routes = [
  {
    path: '',
    component: BasePage,
    children: [
      {
        path: '',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../home/home.module').then(m => m.HomePageModule)
          }
        ]
      },
      {
        path: 'favoris',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../favoris/favoris.module').then(m => m.FavorisPageModule)
          }
        ]
      },
      {
        path: 'leagues',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../leagues/leagues.module').then(m => m.LeaguesPageModule)
          }
        ]
      },
      {
        path: 'product',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../product/product.module').then(m => m.ProductPageModule)
          }
        ]
      },
      {
        path: 'login',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../login.component').then(m => m.LoginComponent)
          }
        ]
      },
      {
        path: 'account',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../account/account.module').then(m => m.AccountPageModule)
          }
        ]
      },
      {
        path: 'livraison/edit',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../account/livraison.module').then(m => m.LivraisonModule)
          }
        ]
      },
      {
        path: 'panier',
        children: [
          {
            path: '',
            loadChildren: () =>
                import('../panier/panier.module').then(m => m.PanierPageModule)
          }
        ]
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class BasePageRoutingModule {}
