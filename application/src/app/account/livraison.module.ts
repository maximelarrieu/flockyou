import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { IonicModule } from '@ionic/angular';
import { AuthGuard } from '../auth-guard.service';
import { LivraisonFormComponent } from './livraison-form.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
  ],
  declarations: [
    // Initialisation du component générant le formulaire d'édition/création
    LivraisonFormComponent
  ],
  providers: [AuthGuard],
})
export class LivraisonModule { }
