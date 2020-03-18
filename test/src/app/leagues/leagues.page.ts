import { Component, OnInit, Injectable } from '@angular/core';
import { League, LeaguesService } from './leagues.service';

@Component({
  selector: 'app-leagues',
  templateUrl: './leagues.page.html',
  styleUrls: ['./leagues.page.scss'],
})
export class LeaguesPage implements OnInit {

  public leagues: League[];

  constructor(private data: LeaguesService) { }

  ngOnInit() {
    this.data.getLeagues().subscribe(
      leagues => this.leagues = leagues
    );
    // console.log(this.leagues);
  }
}

