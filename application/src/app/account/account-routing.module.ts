import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AccountPage } from './account.page';

import { AuthGuard } from '../auth-guard.service';
import { EditLivraisonComponent } from './edit-livraison.component';

const routes: Routes = [
  {
    path: '',
    component: AccountPage,
    canActivate: [AuthGuard]
  },
  { path: 'livraison/edit', component: EditLivraisonComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AccountPageRoutingModule {}
