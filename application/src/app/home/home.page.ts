import { HomeService, Product, Size } from './home.service';
import { Component, OnInit } from '@angular/core';
import { HomeComponent } from './home.component';
import { FavorisComponent } from '../favoris/favoris.component';
import { FavorisService, Favoris } from '../favoris/favoris.service';
import { ApifootballService, Foot } from '../api/apifootball.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.component.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  // Initialisation des tableaux d'objets que l'on souhaite récupérer
  public products: Product[];
  public sizes: Size[];
  public foots: Foot[];

  constructor(private data: HomeService, private favoris : Favoris, private foot: ApifootballService) { }

  // Fonction d'ajout de produit aux favoris
  AddFav = function(product): void {
    // Utilisation de la fonction add dans FavorisService
    this.favoris.add(product)
  }

  ngOnInit() {
    // Initialisation de la page avec la fonction récupération du service & assignation d'une variable aux éléments
    this.data.getProducts().subscribe(
      products => this.products = products
    );

    // Initialisation de la page avec la fonction récupération du service & assignation d'une variable aux éléments
    this.data.getSizes().subscribe(
      sizes => this.sizes = sizes
    )
    
    // Initialisation de la page avec la fonction récupération du service API & assignation d'une variable aux données
    // this.foot.getFoot().subscribe(
    //   foots => this.foots = console.log(foots)
    // )

  }

}
