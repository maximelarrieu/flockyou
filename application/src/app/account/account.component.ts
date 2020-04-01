import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { AccountService, Livraison } from './account.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.css']
})
export class AccountComponent implements OnInit {

  livraison: Livraison = null;

  constructor(private authService: AuthService, private route: ActivatedRoute, private router: Router, private livraisonService: AccountService) {}

  ngOnInit() {}
}
