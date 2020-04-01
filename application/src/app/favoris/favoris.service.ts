import { Injectable } from '@angular/core';
import { Product } from '../home/home.service';
import { Observable, pipe } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})

@Injectable()
export class Favoris {

  favproducts: any = [];

  // Fonction d'ajout ('push') d'un produit dans un tableau
  add(product) {
    this.favproducts.push(product);
  }

  // Fonction de récupération des produits ajoutés aux favoris
  getFavProducts() {
    return this.favproducts
  }

  constructor() {}
}

export class FavorisService {


constructor() { }

}
