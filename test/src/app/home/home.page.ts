import { HomeService, Size } from './home.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  public sizes: Size[];

  constructor(private data: HomeService) { }

  ngOnInit() {
    this.data.getSizes().subscribe(
      sizes => this.sizes = sizes
    );
    // console.log(this.leagues);
  }

}
