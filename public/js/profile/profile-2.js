$ = jQuery;

function getAllData(user) {
	if (1 == 1) {
	var dist2015 = 0;
	var dist2016 = 0;
	var dist2016MaiIulie = 0;
	var dur2015 = 0;
	var dur2016 = 0;
	var dur2016MaiIulie = 0;
	var viteza2015 = 0;
	var viteza2016 = 0;
	var viteza2016MaiIulie = 0;
	var contor2015 = 0;
	var contor2016 = 0;
	var contor2016MaiIulie = 0;
	var avgViteza2015 = 0;
	var avgViteza2016 = 0;
	var avgViteza2016MaiIulie = 0;
	var avgViteza20152 = 0;
	var avgViteza20162 = 0;
	var vitezaMedie = 0;
	var map;
	var calcule = true;

			var contor2015 = 0;
			var contor2016 = 0;
			var contor2016MaiIulie = 0;



			$('#tf-trBike2Work2016, #tf-trBike2Work2016MaiIulie, #tf-trBike2Work2015').hide();
			$('#tf-trBike2Worktotal, #aiCompletat').show();

			var table = jQuery('#track-list tbody');
			var path = 'http://dev.risksoft.ro/bike/dump.php';
			//var path = 'http://ivelo.conceptapps.ro/api/bike2work/' + user;
			console.log(path);
			
			rows = '';
			jQuery.getJSON(path, function(response) {
				//console.log('response status: '+response.status);
				if (response.status == 'ok') {
					console.log(response.status);
					if (response.data.length > 0) { // mail ok, trips found
						if (response.data.length < 8) {
							jQuery('#total-tracks').html(response.data.length);
						} else {
							jQuery('#tf-tr').html('<span style="color:green">Ai completat toate traseele necesare campaniei! Felicitari!</span>');
						};
						jQuery.each(response.data, function(index, value) {

							//adaugare timestamp
							var str = value.end_time;
							var res = str.substring(0, 10);
							var res2 = res.split('-');
							//var myVar21 = ((new Date(res2[0], res2[1]-1, res[2])).getTime())

							var myVar3 = parseFloat(res2[0]);
							var myVar4 = parseFloat(res2[1]) - 1;
							var myVar5 = parseFloat(res2[2]);

							myVar2 = new Date(myVar3, myVar4, myVar5).getTime();

							if ((myVar2 / 1000) < 1442005199) {
								contor2015 += 1;
								var clasament = "Bike2Work 2015";
								var clasamentClass = "Bike2Work2015";
								dist2015 += parseFloat(value.distance);
								dur2015 += parseFloat(value.duration);
								viteza2015 += parseFloat(value.avg_speed);
								avgViteza2015 = (viteza2015 / contor2015).toFixed(2);
								avgViteza20152 = (viteza2015 / contor2015);
								// TODO: verificat si in bd daca timestampul e decalat sau nu.
								//		facut statistici & stuff si pentru mai iulie					 
							}
							if (myVar2 / 1000 > 1463346000 && myVar2 / 1000 < 1468602000) {
								contor2016MaiIulie += 1;
								clasament = "Bike2Work 2016 Mai Iulie";
								clasamentClass = "Bike2Work2016MaiIunie Bike2Work2016";
								dist2016MaiIulie += parseFloat(value.distance);
								dur2016MaiIulie += parseFloat(value.duration);
								viteza2016MaiIulie += parseFloat(value.avg_speed);
								avgViteza2016MaiIulie = (viteza2016MaiIulie / contor2016MaiIulie).toFixed(2);
								avgViteza20162MaiIulie = (viteza2016MaiIulie / contor2016MaiIulie);
							}
							if (myVar2 / 1000 > 1442005199) {
								contor2016 += 1;
								clasament = "Bike2Work 2016";
								clasamentClass = "Bike2Work2016";
								dist2016 += parseFloat(value.distance);
								dur2016 += parseFloat(value.duration);
								viteza2016 += parseFloat(value.avg_speed);
								avgViteza2016 = (viteza2016 / contor2016).toFixed(2);
								avgViteza20162 = (viteza2016 / contor2016);
							}



							//afisare in tabel 2015
							//dist20152 =  parseFloat(Math.round(dist2015 * 100) / 100).toFixed(2);
							dist20152 = dist2015.toFixed(2);
							jQuery('#totalDistBike2Work2015').html(dist20152);
							jQuery('#totalDurBike2Work2015').html(dur2015);
							jQuery('#vitezaMedieike2Work2015').html(avgViteza2015);
							jQuery('#traseeTotale2015').html(contor2015);

							//afisare in tabel 2016

							dist20162 = dist2016.toFixed(2);
							jQuery('#totalDistBike2Work2016').html(dist20162);
							jQuery('#totalDurBike2Work2016').html(dur2016);
							jQuery('#vitezaMedieike2Work2016').html(avgViteza2016);
							jQuery('#traseeTotale2016').html(contor2016);

							//afisare in tabel 2016 Mai Iulie

							jQuery('#totalDistBike2Work2016MaiIulie').html(dist2016MaiIulie.toFixed(2));
							jQuery('#totalDurBike2Work2016MaiIulie').html(dur2016MaiIulie);
							jQuery('#vitezaMedieike2Work2016MaiIulie').html(avgViteza2016MaiIulie);
							jQuery('#traseeTotale2016MaiIulie').html(contor2016MaiIulie);


							//afisare in tabel total

							vitezaMedie = (avgViteza2016 + avgViteza2015) % 10;
							vitezaMedie2 = (avgViteza20162 + avgViteza20152).toFixed(2);
							distTot = (dist2016 + dist2015).toFixed(2);
							jQuery('#totalDistBike2Worktotal').html(distTot);
							jQuery('#totalDurBike2Worktotal').html(dur2016 + dur2015);
							jQuery('#vitezaMedieike2Worktotal').html(vitezaMedie2);
							jQuery('#traseeTotale').html(contor2015 + contor2016);



							nume_cursa = value.title;
							st = value.start_time.replace(/-/g, '/');
							et = value.end_time.replace(' ', '<br />');
							//TODO scos harta + arata traseu si pus link-ul pe numele traseului						  


							if (value.smalltracks == '' || typeof(value.smalltracks) == 'undefined') {

								rows += '<tr ' + 'class = "' + clasamentClass + '"><td><a href="javascript:void(0)" class="show-track" data-polyline="' + value.track + '">' + nume_cursa + '</a></td><td>' + st + '</td><td>' + value.duration + ' min</td><td>' + value.avg_speed + ' km/h</td><td>' + value.max_speed + ' km/h</td><td class = "distana">' + value.distance + ' km</td><td>' + clasament + '</td></tr>';

								console.log(value.smalltracks);

								//addtrack(value.track);

							} else {


								console.log(value.smalltracks);


								rows += '<tr ' + 'class = ' + clasamentClass + '><td><a href="javascript:void(0)" class="show-multiple-tracks" data-polylines="';


								jQuery(value.smalltracks).each(function(k, v) {

									if (v.type === 1) {

										rows += v.track + 'dap-sfarsit-';
										//addtracks(v.track, '#ea057a', 0);
									} else {
										rows += v.track + 'nup-sfarsit-';
										//addtracks(v.track, '#aaaaaa', 0);
									}
								})

								rows += ' ">' + nume_cursa + '</a></td><td>' + st + '</td><td>' + value.duration + ' min</td><td>' + value.avg_speed + ' km/h</td><td>' + value.max_speed + ' km/h</td><td class = "distana">' + value.distance + ' km</td><td>' + clasament + '</td></tr>';
							}
							calcule = false;

						});

						if (contor2016MaiIulie >= 4) {
							jQuery('#aiCompletat').show();
						} else {
							jQuery('#aiCompletat').hide();
						}

						jQuery(table).empty();
						jQuery(rows).appendTo(table);
						//rewriteTable(false);
					} else { // mail ok, no trips yet
						rows = '<td colspan="6" class="info">Nu ai inca vreun traseu inregistrat in aplicatia iVelo. <br />Nu vor fi afisate aici decat traseele cu titlul "bike2work" din aplicatie.</td>';
						jQuery(table).empty();
						jQuery(rows).appendTo(table);
					}
				} else {
					//rows = '<td colspan="6" class="info">Descarca aplicatia iVelo pe smartphone-ul tau pentru a iti inregistra traseele catre si de la serviciu! <br />Daca ti-ai descarcat deja aplicatia si ti-ai facut cont, asigura-te ca e-mail-ul folosit la inregistrarea pe site-ul Bike2Work este acelasi cu cel inregistrat in aplicatie. Odata ce mail-urile sunt identice, vei vedea aici traseele inregistrate in aplicatie. Mail-ul contului tau pe site-ul Bike 2 Work este "<?php echo $email ?>"</td>';
					jQuery(table).empty();
					jQuery(rows).appendTo(table);
				}
			});



		} else {
			rows = '<td colspan="6" class="info">Trebuie sa fi inregistrat pe Bike 2 Work pentru a iti urmari statisticile.</td>';
			jQuery(table).empty();
			jQuery(rows).appendTo(table);
		}

	}

$( document ).ready( function() {
	getAllData();
} );

