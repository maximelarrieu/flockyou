import { Component, OnInit } from '@angular/core';
import { FavorisService } from './favoris.service';

@Component({
  selector: 'app-favoris',
  templateUrl: './favoris.page.html',
  styleUrls: ['./favoris.page.scss']
})
export class FavorisComponent implements OnInit {

  products = [];

  constructor(private favorisService : FavorisService) { }

  AddFav = function(product): void {
    this.favorisService.add(product)
  }

  ngOnInit() {
    this.products = this.favorisService.getProducts()
  }

}
