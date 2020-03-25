import { Injectable } from '@angular/core';
import { Product } from '../home/home.service';

@Injectable({
  providedIn: 'root'
})
export class FavorisService {

  products: any = [];

  add(product) {
    console.log(this.products);
    this.products.push(product);
  }

  getProducts() {
    return this.products
  }

constructor() { }

}
