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

  public static fromJson(json: Object): Favoris {
    return new Favoris();
  }

  add(product) {
    console.log(this.favproducts);
    this.favproducts.push(product);
  }

  getFavProducts(): Observable<Favoris[]> {
    return this.getFavProducts.pipe(
      map
    )
  }

  // getFavProducts() {
  //   return this.favproducts
  // }

  constructor() {}
}

export class FavorisService {


constructor() { }

}
