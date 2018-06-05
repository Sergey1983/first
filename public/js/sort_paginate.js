$(document).ready(function(){


  // SORTER

    $('table.sortable').each(function(){


    var table = $(this);


    $('th', table).each(function(column){


          var findSortKey;

          if ( $(this).hasClass("sort-numeric") ) {

            findSortKey = function (cell) {

              return cell.text();

            };


          } else if ( $(this).hasClass("sort-date") ) {

            findSortKey = function (cell) {

              var date = cell.text();

              date = date.replace(/(\d+)\-(\d+)\-(\d+)/, '$2\-$1\-$3' );

              return Date.parse( date );


            };

          }



          if (findSortKey) {


              $(this).addClass('clickable').hover(function() {

                        $(this).addClass('hover');

                      }, function() {

                        $(this).removeClass('hover');

                      })
          
              .click(function() {

            
                var direction = 0;

                if ( $(this).hasClass("up") ) {

                   direction = 1;

                }



                var tbody = $('.tbody_sort_paginate', table);  

                var rows = tbody.find('tr').get();

console.log(rows.length);
console.log(rows);




                $.each(rows, function (index, row){

                  row.sortKey = findSortKey( $(row).children('td').eq(column) );

                });



                rows.sort(function(a,b) { 


                  if (direction) {

                    return (a.sortKey) - (b.sortKey);

                  } else {

                    return  (b.sortKey) - (a.sortKey);

                  }

                });


        
                $.each(rows, function(index, row) {

                  tbody.append(row);

                  row.sortKey = null;

                });

                table.trigger('paginate');

                $(this).toggleClass("up"); 



              });

        } 

    });




 });

    // END-OF SORTER

});


$(document).ready(function(){




  $.fn.lt = function(n) {return this.slice(0,n);};

  $.fn.gt = function(n) {return this.slice(n+1);};



console.log($.fn.lt);


  $('table.repaginate').each(function() {

      var table = $(this);

      var currentPage = 0;

      var rowsNumber = $(".tbody_sort_paginate", this).find('tr').length;

      var numPerPage = 5;

      function numOfPagesF () {


        return numOfPages = Math.ceil(rowsNumber/numPerPage);

      }


      numOfPagesF();






      table.on('paginate', function() {

        table.find('tbody tr').show()

          .lt(currentPage * numPerPage)

            .hide()

          .end()

          .gt((currentPage + 1) * numPerPage - 1)

            .hide()

          .end();

      });




      var divSelectAndPager = $('<div class="SelectAndPager"></div>');


      var selectNumPerPage = $('<select class="selectNumPerPage inline">'+
      '<option value="5">5</option>'+
      '<option value="12">12</option>'+
      '<option value="25">25</option>'+
      '<option value="50">50</option>'+
      '<option value="'+ rowsNumber + '" >Все</option> </select>');

      // $(".selectNumPerPage").remove();

      $(selectNumPerPage).appendTo(divSelectAndPager);



      var pageSelector = function () {

        var pager = $('<div class="pager inline">Стр. </div>');

        for (page=0; page < numOfPages; page++) {
      
          $('<span class="pagenumber">' + ( page + 1) + ' </span>')

            .hover(function() {

                          $(this).addClass('hover');

                        }, function() {

                          $(this).removeClass('hover');

                        })

            .on('click', { newPage: page}, function(event) {

                currentPage = event.data.newPage;
                
                table.trigger('paginate');

                $(this).addClass("active").siblings().removeClass("active");


            })

            .appendTo(pager);



        }

        pager.find('span.pagenumber:first').addClass('active');

        $(".pager").remove();

        $(pager).appendTo(divSelectAndPager);

      };


      

      $('.SelectAndPager').remove();

      pageSelector();

      $(divSelectAndPager).insertBefore(this);



      table.trigger('paginate');
     





      $('.selectNumPerPage').on('change', 

        function () {

            numPerPage = $('.selectNumPerPage').val();

            currentPage = 0;

            numOfPagesF();

            table.trigger('paginate');

            pageSelector();       

                    

           }

      );



  });

  // END-OF pageSelector

});
