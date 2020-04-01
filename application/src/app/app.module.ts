import { HomeService } from './home/home.service';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';

import { IonicModule, IonicRouteStrategy } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { StoreModule } from '@ngrx/store';
import { reducers, metaReducers } from './reducers';

import { FormsModule } from '@angular/forms';
import { LoginComponent } from './login.component';
import { LoginRoutingModule } from './login-routing.module';

import { HttpClientModule } from '@angular/common/http';
import { LeaguesService } from './leagues/leagues.service';
import { AccountService } from './account/account.service';
import { ApifootballService } from './api/apifootball.service';


@NgModule({
  declarations: [AppComponent, LoginComponent],
  entryComponents: [],
  imports: [
    BrowserModule,
    IonicModule.forRoot(),
    FormsModule,
    LoginRoutingModule,
    AppRoutingModule,
    HttpClientModule,
    StoreModule.forRoot(reducers, {
      metaReducers,
      runtimeChecks: {
        strictStateImmutability: true,
        strictActionImmutability: true
      }
    })
  ],
  providers: [
    StatusBar,
    SplashScreen,
    LeaguesService,
    HomeService,
    AccountService,
    ApifootballService,
    { provide: RouteReuseStrategy, useClass: IonicRouteStrategy, useValue: "dummy"}
  ],
  bootstrap: [AppComponent]
})
export class AppModule {}
