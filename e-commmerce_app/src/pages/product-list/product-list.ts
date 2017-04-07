import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {Http} from "@angular/http";
import 'rxjs/add/operator/toPromise';
import {ProductDetailPage} from "../product-detail/product-detail";


/*
  Generated class for the ProductList page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-product-list',
  templateUrl: 'product-list.html'
})
export class ProductListPage {

  public products = [];

  constructor(
  	public navCtrl: NavController, 
  	public navParams: NavParams , 
  	public http: Http
  	) {}

  ionViewDidLoad() {
    this.http.get('http://ionic2.myprojects.work/api/products')
    	.toPromise().then((response) => {
    		this.products = response.json();
    	})
  }

  goToProductDetail(product){
    this.navCtrl.push(ProductDetailPage, {id: product.id})
  }

}