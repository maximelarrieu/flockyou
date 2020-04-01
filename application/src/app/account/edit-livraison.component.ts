import { Livraison, AccountService } from "./account.service"
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Params } from '@angular/router';

@Component({
    selector: "edit-livraison",
    template: `
        <h2 class="header center">Editer livraison</h2>    
        <form></form>
    `,
})
export class EditLivraisonComponent implements OnInit {

    livraison: Livraison = null;
    
    constructor(
        private route: ActivatedRoute,
        private livraisonService: AccountService
    ) {}

    ngOnInit() {
        let id = +this.route.snapshot.params['id'];
        this.livraison = this.livraisonService.updateLivraisons(id);
    }
}