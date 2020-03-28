import { HomeService, Product, Size } from './home.service';
import { Component, OnInit } from '@angular/core';
import { HomeComponent } from './home.component';
import { FavorisComponent } from '../favoris/favoris.component';
import { FavorisService, Favoris } from '../favoris/favoris.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.component.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  public products: Product[];
  public sizes: Size[];

  constructor(private data: HomeService, private favoris : Favoris) { }

  AddFav = function(product): void {
    this.favoris.add(product)
  }

  ngOnInit() {
    this.data.getProducts().subscribe(
      products => this.products = products
    );
    this.data.getSizes().subscribe(
      sizes => this.sizes = sizes
    )
  }

}
