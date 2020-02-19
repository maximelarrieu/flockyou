import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LeaguesPageRoutingModule } from './leagues-routing.module';

import { LeaguesPage } from './leagues.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LeaguesPageRoutingModule
  ],
  declarations: [LeaguesPage]
})
export class LeaguesPageModule {}
