import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  { path: '',
    loadChildren: () => import('./base/base.module').then(m => m.BasePageModule) },
  {
    path: 'favoris',
    loadChildren: () => import('./favoris/favoris.module').then( m => m.FavorisPageModule)
  },
  {
    path: 'panier',
    loadChildren: () => import('./panier/panier.module').then( m => m.PanierPageModule)
  },
  {
    path: 'account',
    loadChildren: () => import('./account/account.module').then( m => m.AccountPageModule)
  },
  {
    path: 'product',
    loadChildren: () => import('./product/product.module').then( m => m.ProductPageModule)
  },
  /*{ path: 'home', loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)},
  {
    path: 'leagues',
    loadChildren: () => import('./leagues/leagues.module').then( m => m.LeaguesPageModule)
  },
  */
//  {
//     path: 'login',
//     loadChildren: () => import('./login.component').then( m => m.LoginComponent)
//   },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
