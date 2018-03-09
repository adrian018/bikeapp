 $( document ).ready( function() {
        map = new GMaps({
        div: '#track-map',
        lat: 44.435506,
        lng: 26.102523,
        zoom: 11
     });  
       var polylines = [];
       var decodedPath = google.maps.geometry.encoding.decodePath( "uwpnGiwz}CFK?WCa@FYNSRMPQPOPOPMPORMPOLUB[Ea@Me@Oe@Og@Og@Me@Ma@K_@I]Oc@Mc@Oe@M_@I_@@_@J_@R]R[PULYB[E_@@g@H_@V]ZSZUZWZY\[\[ZW\Q\Q\WXUZUZS\UZSVSZYZY\]ZYZWXUXQXQTOVOVOXSXUZW\[\YZWZSZSXQXKVO\O^S\S^U\W^W\Y\UZW^U\W\UXSVSZSZSXSFQCYO_@M]Ic@Ei@Cm@Co@Co@Cs@Cq@As@Es@Cw@Ew@Ey@Ey@Ew@Ew@Eu@Eu@Eq@Es@Es@Cu@Eu@Cm@Eo@Co@Es@Es@Gu@Eu@Ew@Eu@Cu@Es@Eu@Es@Eu@Es@Eq@Eq@Eo@Em@Ck@Ck@Ck@Eo@Eo@Co@Em@Cm@Eo@Cq@Eq@As@Co@Eo@Ck@Cc@Ec@Ea@Cc@Ci@Ck@Am@Ci@Ag@Cm@?k@Fk@Le@Va@\Y\Y\Y^]\]\_@Z[\]^[Z]Za@Xc@Ze@Xg@Xg@Tk@Tq@Rs@Pu@Po@Po@Nk@Pi@Nk@Nk@Ni@Pk@Nk@Nk@Pi@Li@Ng@Nk@Pg@Lk@Li@Li@Lg@Lg@Ng@Pg@Ne@Ne@Pe@Li@Ng@Ng@Ni@Jg@Li@Lg@Lg@Ng@Le@Lg@Ng@Lg@Le@Le@Ng@Lg@Li@Lg@Lg@Li@Ng@Ng@Pc@Lc@Na@N]PYTMRIPQNWJ[RQXKVEVATDXBVDXAXGXQTQZQXOZMXMXMRQN[J_@L[VUXQXOXMZKZKZK^M^O\QZS^S^U\OZM^M\K\KZMXMZQXMLW@_@Ac@HSNMTKTKXKXIXIZIZK\KXM\OZOXQVMTITKTIVKTKTMRKVIVIXIZM\SZOXMXGVKVIVIXKVMPSN[Nc@P_@PWTQRITCTBZJVPTRRDTCVIXMXMZKZMZO\OZMZMXKXK\K\MZKTMVMZO\O\MZMZOZO\O\M\KZK\IZMZOZQ^O^M\KXMXMZO\M^Q\O^OZM^O\OZOXM\MZKZIZKXIROLQJWJSPGXB^@^AXIXIXMXKXM^Qb@S`@S\O^O\O^OZOTYP_@R[ZKZBVDP@TIZM`@S`@S^QXMZQ^U`@U\QZOVOXO^M`@ST_@Jc@Ac@E[CY@]D[B]@[C_@Aa@Ca@Cc@Cc@Ea@A_@Ca@A_@C_@A]@_@D_@Da@@]@]HUTMZEZAT?VAVCTGLYD_@?k@Aa@C_@E[E[C_@?_@JWNQLU@a@?g@Ce@Ac@Ca@Ce@Cc@Cg@Ag@Ak@Am@Ak@?k@?e@FYLKTEVIVKXGVETKJY@]Aa@?_@DYLQRBLR" );
        
        var polyline = map.drawPolyline({
            path: decodedPath,
            strokeColor: '#131540',
            strokeOpacity: 0.6,
            strokeWeight: 6
        });
        zoomToObject(decodedPath);
        // polylines.push(polyline);
       
     function zoomToObject(obj) {
        var bounds = new google.maps.LatLngBounds();
        var points = obj;
        for (var n = 0; n < points.length; n++) {
            bounds.extend(points[n]);
        }
        map.fitBounds(bounds);
    }

    });