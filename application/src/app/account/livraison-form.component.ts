import { Component, Input, OnInit } from "@angular/core";
import { Router } from '@angular/router';
import { AccountService, Livraison } from './account.service';

@Component({
    selector: 'livraison-form',
    templateUrl: './livraison-form.component.html',
    styleUrls:  ['./livraison-form.component.css'],
})
export class LivraisonFormComponent implements OnInit {

    @Input() livraison: Livraison;

    types: Array<string>;
    constructor(private AccountService: AccountService, private router: Router) {}

    ngOnInit() {

    }

    // Validation du formulaire d'édition
    onSubmit(): void {
        console.log("Formulaire soumis!");
        this.AccountService.updateLivraisons(this.livraison)
        .subscribe(() => this.goBack());
    }

    // Fonction retour en arrière vers page 'account'
    goBack(): void {
        let link = ['/account'];
        this.router.navigate(link);
    }
}