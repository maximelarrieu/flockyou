import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class Product {

    // Fonction qui détermine quelles sont les valeurs que nous voudrons récupérer dans le JSON que nous renvoi l'API Platform
    // Ici : tout l'objet
  public static fromJson(json: Object): Product {
    return new Product();
  }

  constructor() {
  }
}

@Injectable()
export class Size {

    // Fonction qui détermine quelles sont les valeurs que nous voudrons récupérer dans le JSON que nous renvoi l'API Platform
    // Ici : le nom
  public static fromJson(json:Object): Size {
    return new Size(
      json['name']
    );
  }
  constructor(public size: string) {

  }
}

@Injectable()
export class HomeService {

  constructor(protected http: HttpClient) {}
  
  // URL vers APIPlatform
  private productsUrl = 'https://localhost:8000/api/products?page=1';  // URL to web api
  
  // Fonction d'extraction des données où l'on parcourt le tableau 'hydra:member' pour les récupérer
  public getProducts(): Observable<Product[]> {
    return this.http.get<Product[]>(this.productsUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    );
  }

  // URL vers APIPlatform
  private sizeUrl = 'https://localhost:8000/api/sizes?page=1';

  // Fonction d'extraction des données où l'on parcourt le tableau 'hydra:member' pour les récupérer
  public getSizes(): Observable<Size[]> {
    return this.http.get<Size[]>(this.sizeUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    )
  } 

}
