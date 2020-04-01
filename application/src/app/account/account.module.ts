import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AccountPageRoutingModule } from './account-routing.module';

import { AccountPage } from './account.page';
import { AuthGuard } from '../auth-guard.service';

import { EditLivraisonComponent } from './edit-livraison.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AccountPageRoutingModule
  ],
  declarations: [
    AccountPage,
    // Component gérant l'obtention du bouton d'édition qui mène au formulaire
    EditLivraisonComponent,
  ],
  providers: [AuthGuard]
})
export class AccountPageModule {}
