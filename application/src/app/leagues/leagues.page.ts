import { Component, OnInit, Injectable } from '@angular/core';
import { League, LeaguesService } from './leagues.service';

@Component({
  selector: 'app-leagues',
  templateUrl: './leagues.page.html',
  styleUrls: ['./leagues.page.scss'],
})
export class LeaguesPage implements OnInit {

  // Initialisation des tableaux d'objets que l'on souhaite récupérer
  public leagues: League[];

  constructor(private data: LeaguesService) { }

  ngOnInit() {
    // Initialisation de la page avec la fonction récupération du service & assignation d'une variable aux éléments
    this.data.getLeagues().subscribe(
      leagues => this.leagues = leagues
    );
  }
}

