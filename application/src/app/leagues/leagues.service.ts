import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable()
export class League {

  // Fonction qui détermine quelles sont les valeurs que nous voudrons récupérer dans le JSON que nous renvoi l'API Platform
  // Ici : le nom et l'image
  public static fromJson(json: Object): League {
    return new League(
      json['name'],
      json['image']
    );
  }
  constructor(public name: string,
              public image: string) {
  }
}

@Injectable()
export class LeaguesService {

  constructor(protected http: HttpClient) {}
  
  // URL vers APIPlatform
  private leaguesUrl = 'https://localhost:8000/api/leagues?page=1';
  
  // Fonction d'extraction des données où l'on parcourt le tableau 'hydra:member' pour les récupérer
  public getLeagues(): Observable<League[]> {
    return this.http.get<League[]>(this.leaguesUrl).pipe(
      map(
        (data => data['hydra:member'])
        
      )
    );
  }
};
