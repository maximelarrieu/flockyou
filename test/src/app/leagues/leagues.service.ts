import { Observable } from 'rxjs';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class LeaguesService {

  constructor(
    private http: HttpClient,
  ) { }

  private leaguesUrl = 'api/leagues';  // URL to web api

  getLeagues(): Observable<LeaguesService[]> {
      return this.http.get<LeaguesService[]>(this.leaguesUrl);
  }
  this.http.get<Any[]>().subscribe((resp) => {
    console.log(resp);
  }

};
