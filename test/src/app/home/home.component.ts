import { Component, OnInit } from '@angular/core';
import { FavorisService } from '../favoris/favoris.service';
import { LivesoccerService } from '../api/livesoccer.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.page.css']
})
export class HomeComponent implements OnInit {

  constructor(private favorisService : FavorisService, private livesoccerService : LivesoccerService) { }

  // livescores: any = [];

  // AddFav = function(product): void {
  //   this.favorisService.add(product)
  // }

  // getLiveScore() {
  //   this.livesoccerService.getLiveScores()
  //   .subscribe(data => {
  //     for (const d of (data as any)) {
  //       this.livescores.push({
  //         goalsHomeTeam: d.goalsHomeTeam
  //       })
  //     }
  //     console.log(this.livescores);
  //   });
  // }

  ngOnInit() {

  }

}
