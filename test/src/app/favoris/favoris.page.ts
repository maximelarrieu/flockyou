import { Component, OnInit } from '@angular/core';
import { Favoris } from './favoris.service';

@Component({
  selector: 'app-favoris',
  templateUrl: './favoris.page.html',
  styleUrls: ['./favoris.page.scss'],
})
export class FavorisPage implements OnInit {
  
  public favoris: Favoris[];
  
  constructor(private datafavoris: Favoris) { }

  ngOnInit() {
    this.datafavoris.getFavProducts(
      // favoris => this.favoris = favoris
    );
  }

}
