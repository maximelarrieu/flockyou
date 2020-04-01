import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { RequestOptionsArgs } from './requestOptionsArgs';

@Injectable()
export class Foot {
  public static fromJson(json: Object): Foot {
    return new Foot;
  }

  constructor() {};
}

@Injectable()
// Service pour tenter de récupérer des données de l'API
export class ApifootballService {
  // url: string;
  // headers: Headers;

// constructor(protected http: HttpClient, public url: string, public headers: Headers) { }

// // API Token
// private header = new Headers({"X-Auth-Token": "cb08921c4amshaf0ad5be2b81d0ep1c2bc9jsn69c33a23b5e0"})
// // Options pour importer token dans l'URL
// private options = RequestOptionsArgs({headers: this.header})
// // URL vers APIFootball
// private footUrl = "https://api-football-v1.p.rapidapi.com/v2/fixtures/live?timezone=Europe/London";

// // Fonction récupération des données de l'API
// public getFoot() {
  // return this.http.get<Foot[]>(this.footUrl, this.options);
// }

}
