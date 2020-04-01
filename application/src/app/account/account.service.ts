import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map, tap, catchError } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})

@Injectable()
export class Livraison {

  // Fonction qui détermine quelles sont les valeurs que nous voudrons récupérer dans le JSON que nous renvoi l'API Platform
  // Ici : tout l'objet
  public static fromJson(json: Object): Livraison {
    return new Livraison();
  }
  constructor() {}
}

@Injectable()
export class AccountService {

constructor(protected http: HttpClient) {}

  // URLs vers APIPlatform
  private livraisonUrl = 'https://localhost:8000/api/livraisons?page=1';
  private deleteLivraisonUrl = 'https://localhost:8000/api/livraisons/';

  // Fonction d'extraction des données où l'on parcourt le tableau 'hydra:member' pour les récupérer
  public getLivraisons(): Observable<Livraison[]> {
    return this.http.get<Livraison[]>(this.livraisonUrl).pipe(
      map(
        (data => data['hydra:member'])
      )
    );
  }

  // Test fonction de suppression de livraison
  public deletedLivraison(livraison): Observable<Livraison> {
    return this.http.delete<Livraison>(this.deleteLivraisonUrl + livraison);
  }

  // ENSEMBLE DES FONCTIONS TESTS D'UPDATE ET DE DELETE SUR LIVRAISON

  updateLivraisons(livraison: Livraison): Observable<Livraison> {
    const httpOptions = {
      headers: new HttpHeaders({'Content-Type': 'application/json'})
    };

    return this.http.put(this.livraisonUrl, livraison, httpOptions).pipe(
      tap(_ => this.log(`updated livraison id=${livraison.id}`)),
      catchError(this.handleError<any>('updatedLivraison'))
    )
  }

  // deleteLivraison(livraison: Livraison): Observable<Livraison> {
  //   const url = `${this.livraisonUrl}/${livraison.id}`;
  //   const httpOptions = {
  //     headers: new HttpHeaders({'Content-Type': 'applicatioin/json'})
  //   };

  //   return this.http.delete<Livraison>(url, httpOptions).pipe(
  //     tap(_ => this.log(`deleted livraison id=${livraison.id}`))
  //   );
  // }

}
