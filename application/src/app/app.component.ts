import { Component } from '@angular/core';
import { OnInit } from '@angular/core';

import { Product } from './product';
import { PRODUCTS } from './mock-products'

@Component({
    selector: 'flockyou-app',
    templateUrl: `./app/app.component.html`,
})
export class AppComponent implements OnInit { 

    private products: Product[];
    private title: string = "Liste des produits"

    ngOnInit() {
        this.products = PRODUCTS;    
    }

    selectProduct(product: Product) {
        alert("Vous avez cliqué sur le maillot " + product.team + " - " + product.state);
    }
}