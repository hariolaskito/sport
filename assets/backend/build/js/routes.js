(function(name, definition) {
    if (typeof module != 'undefined') {
      module.exports = definition();
    } else if (typeof define == 'function' && typeof define.amd == 'object') {
      define(definition);
    } else {
      this[name] = definition();
    }
  }('Router', function() {
  return {
    routes: [{"uri":"\/","name":"home.index"},{"uri":"contact","name":"home.contact"},{"uri":"about","name":"home.about"},{"uri":"promo","name":"home.promo"},{"uri":"adminpage","name":"adminpage"},{"uri":"adminpage\/login","name":"user.login"},{"uri":"adminpage\/dashboard","name":"dashboard"},{"uri":"adminpage\/user","name":"user.index"},{"uri":"adminpage\/user\/create","name":"user.create"},{"uri":"adminpage\/user","name":"user.store"},{"uri":"adminpage\/user\/datatable","name":"user.datatable"},{"uri":"adminpage\/user\/{id}","name":"user.update"},{"uri":"adminpage\/user\/{id}","name":"user.edit"},{"uri":"adminpage\/user\/{id}","name":"user.destroy"},{"uri":"adminpage\/logout","name":"user.logout"},{"uri":"adminpage\/article","name":"article.index"},{"uri":"adminpage\/article\/create","name":"article.create"},{"uri":"adminpage\/article","name":"article.store"},{"uri":"adminpage\/article\/datatable","name":"article.datatable"},{"uri":"adminpage\/article\/{id}","name":"article.edit"},{"uri":"adminpage\/article\/{id}","name":"article.update"},{"uri":"adminpage\/article\/{id}","name":"article.destroy"},{"uri":"adminpage\/article_category","name":"article_category.index"},{"uri":"adminpage\/article_category\/create","name":"article_category.create"},{"uri":"adminpage\/article_category","name":"article_category.store"},{"uri":"adminpage\/article_category\/datatable","name":"article_category.datatable"},{"uri":"adminpage\/article_category\/{id}","name":"article_category.edit"},{"uri":"adminpage\/article_category\/{id}","name":"article_category.update"},{"uri":"adminpage\/article_category\/{id}","name":"article_category.destroy"},{"uri":"adminpage\/vehicle","name":"vehicle.index"},{"uri":"adminpage\/vehicle\/create","name":"vehicle.create"},{"uri":"adminpage\/vehicle","name":"vehicle.store"},{"uri":"adminpage\/vehicle\/datatable","name":"vehicle.datatable"},{"uri":"adminpage\/vehicle\/{id}","name":"vehicle.edit"},{"uri":"adminpage\/vehicle\/{id}","name":"vehicle.update"},{"uri":"adminpage\/vehicle\/{id}","name":"vehicle.destroy"},{"uri":"adminpage\/vehicle_seat\/{id}","name":"vehicle_seat.show"},{"uri":"adminpage\/pack_rentcar\/pack\/{startdate}\/{enddate}","name":"pack_rentcar.activepack"},{"uri":"adminpage\/pack_rentcar","name":"pack_rentcar.index"},{"uri":"adminpage\/pack_rentcar\/create","name":"pack_rentcar.create"},{"uri":"adminpage\/pack_rentcar","name":"pack_rentcar.store"},{"uri":"adminpage\/pack_rentcar\/datatable","name":"pack_rentcar.datatable"},{"uri":"adminpage\/pack_rentcar\/{id}","name":"pack_rentcar.edit"},{"uri":"adminpage\/pack_rentcar\/{id}","name":"pack_rentcar.update"},{"uri":"adminpage\/pack_rentcar\/{id}","name":"pack_rentcar.destroy"},{"uri":"adminpage\/route_map\/child\/{id}","name":"route_map.child"},{"uri":"adminpage\/route_map","name":"route_map.index"},{"uri":"adminpage\/route_map\/create","name":"route_map.create"},{"uri":"adminpage\/route_map","name":"route_map.store"},{"uri":"adminpage\/route_map\/datatable","name":"route_map.datatable"},{"uri":"adminpage\/route_map\/{id}","name":"route_map.edit"},{"uri":"adminpage\/route_map\/{id}","name":"route_map.update"},{"uri":"adminpage\/route_map\/{id}","name":"route_map.destroy"},{"uri":"city\/show\/{id}","name":"city.show"},{"uri":"trans_rentcar\/create","name":"trans_rentcar.create"},{"uri":"trans_rentcar","name":"trans_rentcar.store"},{"uri":"trans_rentcar\/report","name":"trans_rentcar.report"},{"uri":"trans_rentcar\/datatable","name":"trans_rentcar.datatable"},{"uri":"trans_rentcar\/detail\/{id}","name":"trans_rentcar.detail"},{"uri":"trans_rentcar\/print","name":"trans_rentcar.print"},{"uri":"trans_rentcar\/{id}","name":"trans_rentcar.destroy"},{"uri":"trayek","name":"trayek.index"},{"uri":"trayek\/create","name":"trayek.create"},{"uri":"trayek","name":"trayek.store"},{"uri":"trayek\/datatable","name":"trayek.datatable"},{"uri":"trayek\/{id}","name":"trayek.edit"},{"uri":"trayek\/{id}","name":"trayek.update"},{"uri":"trayek\/{id}","name":"trayek.destroy"},{"uri":"adminpage\/schedule\/available\/{source_city}\/{target_city}\/{date}\/{quantity}","name":"schedule.available"},{"uri":"adminpage\/schedule\/generate\/{id}","name":"schedule.generate"},{"uri":"adminpage\/schedule","name":"schedule.index"},{"uri":"adminpage\/schedule\/create","name":"schedule.create"},{"uri":"adminpage\/schedule","name":"schedule.store"},{"uri":"adminpage\/schedule\/datatable","name":"schedule.datatable"},{"uri":"adminpage\/schedule\/{id}","name":"schedule.edit"},{"uri":"adminpage\/schedule\/{id}","name":"schedule.update"},{"uri":"adminpage\/schedule\/{id}","name":"schedule.destroy"},{"uri":"adminpage\/trans_travel\/create","name":"trans_travel.create"},{"uri":"adminpage\/trans_travel","name":"trans_travel.store"},{"uri":"adminpage\/trans_travel\/schedule","name":"trans_travel.schedule"},{"uri":"adminpage\/trans_travel\/report","name":"trans_travel.report"},{"uri":"adminpage\/trans_travel\/datatable","name":"trans_travel.datatable"},{"uri":"adminpage\/trans_travel\/detail\/{id}","name":"trans_travel.detail"},{"uri":"adminpage\/trans_travel\/print\/ticket\/{id}","name":"trans_travel.print_ticket"},{"uri":"adminpage\/trans_travel\/{id}","name":"trans_travel.destroy"},{"uri":"adminpage\/setting","name":"setting.index"},{"uri":"adminpage\/setting","name":"setting.store"}],
    route: function(name, params) {
      var route = this.searchRoute(name),
          rootUrl = this.getRootUrl(),
          result = "",
          compiled = "";

      if (route) {
        compiled = this.buildParams(route, params);
        result = this.cleanupDoubleSlashes(rootUrl + '/' + compiled);
        result = this.stripTrailingSlash(result);
        return result;
      }

    },
    searchRoute: function(name) {
      for (var i = this.routes.length - 1; i >= 0; i--) {
        if (this.routes[i].name == name) {
          return this.routes[i];
        }
      }
    },
    buildParams: function(route, params) {
      var compiled = route.uri,
          queryParams = {};

      for (var key in params) {
        if (compiled.indexOf('{' + key + '?}') != -1) {
          if (key in params) {
            compiled = compiled.replace('{' + key + '?}', params[key]);
          }
        } else if (compiled.indexOf('{' + key + '}') != -1) {
          compiled = compiled.replace('{' + key + '}', params[key]);
        } else {
          queryParams[key] = params[key];
        }
      }

      compiled = compiled.replace(/\{([^\/]*)\?}/g, "");

      if (!this.isEmptyObject(queryParams)) {
        return compiled + this.buildQueryString(queryParams);
      }

      return compiled;
    },
    getRootUrl: function() {
      return window.location.protocol + '//' + window.location.host + "/webtravel";
    },
    buildQueryString: function(params) {
      var ret = [];
      for (var key in params) {
        ret.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
      }
      return '?' + ret.join("&");
    },
    isEmptyObject: function(obj) {
      var name;
      for (name in obj) {
        return false;
      }
      return true;
    },
    cleanupDoubleSlashes: function(url) {
      return url.replace(/([^:]\/)\/+/g, "$1");
    },
    stripTrailingSlash: function(url) {
      if(url.substr(-1) == '/') {
        return url.substr(0, url.length - 1);
      }
      return url;
    }
  };
}));