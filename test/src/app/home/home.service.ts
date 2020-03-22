import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class Product {

  public static fromJson(json: Object): Product {
    return new Product();
  }

  constructor() {
  }
}

@Injectable()
export class Size {
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
  
  private productsUrl = 'https://localhost:8000/api/products?page=1';  // URL to web api
  
  public getProducts(): Observable<Product[]> {
    return this.http.get<Product[]>(this.productsUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    );
  }

  private sizeUrl = 'https://localhost:8000/api/sizes?page=1';

  public getSizes(): Observable<Size[]> {
    return this.http.get<Size[]>(this.sizeUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    )
  } 

}
