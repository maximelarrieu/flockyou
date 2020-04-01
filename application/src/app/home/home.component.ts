import { Component, OnInit } from '@angular/core';
import { FavorisService } from '../favoris/favoris.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.page.css']
})
export class HomeComponent implements OnInit {

  constructor(private favorisService : FavorisService) { }

  ngOnInit() {

  }

}
