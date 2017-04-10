import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';

/*
  Generated class for the Cart provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular 2 DI.
*/
@Injectable()
export class Cart {

  public itens = [];
  public total = 0;

  addItem(item){
  	this.itens.push(item);
  	this.calculateTotal();
  }

  calculateTotal(){
  	let total = 0;
  	this.itens.forEach((item) =>{
  		total = total + Number(item.value)
  	});
  	this.total = total;
  }

}
