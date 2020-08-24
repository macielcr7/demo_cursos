import { Component } from '@angular/core';
import { NavController, AlertController } from 'ionic-angular';

import { ApiService } from '../../services/api.services';
import { CursoPage } from '../curso/curso';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {
	itemsList = [];
  itemsListDefault = [];
	constructor(
		public api: ApiService,
		public navCtrl: NavController,
		public alertCtrl: AlertController
	) {

	}

	ionViewDidLoad() {
    	this.searchDataIndex();
    }

    searchDataIndex(){
  		let me = this;
  		me.showLoading(); 
	    
  		me.api.requestIndex({})
  		.then(result => {
  			me.hiddenLoading();
  			me.itemsList = result.data;
        me.itemsListDefault = result.data;
  		}, error => {
        	me.showError("Ops. Ocorreu um erro no sistema");
      	});
  	}

    getItems(event){
        let search = event.target.value;
        this.itemsList = this.itemsListDefault.filter(el => el.titulo.toLocaleLowerCase().indexOf(search.toLocaleLowerCase())>-1);
    }

    open(item){
        this.navCtrl.push(CursoPage, {             
            'id': item.id
        });
    }

  	showLoading() {
        let body = document.body;
        body.classList.remove('loaded');
    }

    hiddenLoading(){
        let body = document.body;
        body.classList.add('loaded');
    }

    showError(text) {
        this.hiddenLoading();
        let alert = this.alertCtrl.create({
              title: 'Atenção',
              subTitle: text,
              buttons: ['OK']
        });
        alert.present();
    }

}
