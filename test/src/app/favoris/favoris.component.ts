import { Component, OnInit } from '@angular/core';
import { FavorisService, Favoris } from './favoris.service';

@Component({
  selector: 'app-favoris',
  templateUrl: './favoris.page.html',
  styleUrls: ['./favoris.page.scss']
})
export class FavorisComponent implements OnInit {

  favproducts = [];

  constructor(private favorisService : Favoris) { }

  AddFav = function(product): void {
    this.favorisService.add(product)
  }

  ngOnInit() {
    this.favproducts = this.favorisService.getFavProducts()
  }

}
