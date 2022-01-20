BX.ready(function() {
    var votelike = BX.create('DIV',{text: 'Да'});
    var votedislike = BX.create('DIV',{text: 'Нет'});
    var table = BX('votetable');//
    //
    var vot = BX.findChild(table, {class: 'like'}, true, true);//
//    
        vot.forEach( function(element) {//
        const ide = element.id;//
        BX.bind(element, 'click', function () {//
    var parelement = BX.findParent(element, {id : element.id});
    BX.cleanNode(parelement);
    parelement.appendChild(BX.create('DIV',{text: 'Like'}));
    //
    //ajax
    addvote(element.id,1);
     });
    });
     var vot = BX.findChild(table, {class: 'dislike'}, true, true);//
//
      vot.forEach( function(element) {//
      const ide = element.id;//
      BX.bind(element, 'click', function () {//
       var pardiselement = BX.findParent(element, {id : element.id});
	BX.cleanNode(pardiselement);
    pardiselement.appendChild(BX.create('DIV',{text: 'Dislike'}));
    //ajax
    addvote(element.id,0);
        });
     });
          
 });     
//
addvote = function(a,b){
     BX.ajax.post (
    '/local/modules/nt.module/lib/helpers/hl.php',
    {id:a, like:b},
    function (result) {
    });
};
