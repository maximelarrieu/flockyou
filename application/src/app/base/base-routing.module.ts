import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BasePage } from './base.page';

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
