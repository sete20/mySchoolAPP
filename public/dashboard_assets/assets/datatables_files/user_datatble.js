  $(function() {
            var dt_basic_table = $('.datatables-basic')
                  , dt_complex_header_table = $('.dt-complex-header')
                  , dt_row_grouping_table = $('.dt-row-grouping')
                  , dt_multilingual_table = $('.dt-multilingual')
                  , dt_basic;

            // DataTable with buttons
            // --------------------------------------------------------------------

            if (dt_basic_table.length) {
                  dt_basic = dt_basic_table.DataTable({
                        bDestroy: true
                        , processing: true
                        , serverSide: true
                        , ajax: "{{route('dashboard.user.index')}}"
                        , columns: [

                              {
                                    data: 'name'
                              }
                              , {
                                    data: 'display_name'
                              }
                              , {
                                    data: 'description'
                              }
                              , {
                                    data: 'created_at'
                              }
                              , {
                                    data: 'updated_at'
                              }
                              , {
                                    data: 'actions'
                              , }
                        ]
                        , scrollY: true
                        , scrollX: true
                        , order: [
                              [2, 'desc']
                        ]
                        , dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
                        , displayLength: 7
                        , lengthMenu: [7, 10, 25, 50, 75, 100],

                        buttons: [{
                                    extend: 'collection'
                                    , className: 'btn btn-label-primary dropdown-toggle me-2'
                                    , text: '<i class="bx bx-export me-sm-2"></i> <span class="d-none d-sm-inline-block">{{ trans('
                                    admin::general.export ') }}</span>'
                                    , buttons: [


                                          {
                                                extend: 'csv'
                                                , text: '<i class="bx bx-file me-2" ></i>Csv'
                                                , className: 'dropdown-item'
                                                , exportOptions: {
                                                      columns: ':visible',
                                                      // prevent avatar to be display
                                                      format: {
                                                            body: function(inner, coldex, rowdex) {
                                                                  if (inner.length <= 0) return inner;
                                                                  var el = $.parseHTML(inner);
                                                                  var result = '';
                                                                  $.each(el, function(index, item) {
                                                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                                              result = result + item.lastChild.firstChild.textContent;
                                                                        } else if (item.innerText === undefined) {
                                                                              result = result + item.textContent;
                                                                        } else result = result + item.innerText;
                                                                  });
                                                                  return result;
                                                            }
                                                      }
                                                }
                                          }
                                          , {
                                                extend: 'pdfHtml5'
                                                , text: '<i class="bx bxs-file-pdf me-2"></i>Pdf'
                                                , className: 'dropdown-item'
                                                , exportOptions: {
                                                      columns: ':visible',
                                                      // prevent avatar to be display
                                                      format: {
                                                            body: function(inner, coldex, rowdex) {
                                                                  if (inner.length <= 0) return inner;
                                                                  var el = $.parseHTML(inner);
                                                                  var result = '';
                                                                  $.each(el, function(index, item) {
                                                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                                              result = result + item.lastChild.firstChild.textContent;
                                                                        } else if (item.innerText === undefined) {
                                                                              result = result + item.textContent;
                                                                        } else result = result + item.innerText;
                                                                  });
                                                                  return result;
                                                            }
                                                      }
                                                }
                                          }
                                          , {
                                                extend: 'excel'
                                                , text: '<i class="bx bxs-file me-2"></i>Excel',

                                                className: 'dropdown-item'
                                                , exportOptions: {
                                                      columns: ':visible',
                                                      // prevent avatar to be display
                                                      format: {
                                                            body: function(inner, coldex, rowdex) {
                                                                  if (inner.length <= 0) return inner;
                                                                  var el = $.parseHTML(inner);
                                                                  var result = '';
                                                                  $.each(el, function(index, item) {
                                                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                                              result = result + item.lastChild.firstChild.textContent;
                                                                        } else if (item.innerText === undefined) {
                                                                              result = result + item.textContent;
                                                                        } else result = result + item.innerText;
                                                                  });
                                                                  return result;
                                                            }
                                                      }
                                                }
                                          }
                                          , {
                                                extend: 'copy'
                                                , text: '<i class="bx bx-copy me-2" ></i>Copy'
                                                , className: 'dropdown-item'
                                                , exportOptions: {
                                                      columns: ':visible',
                                                      // prevent avatar to be display
                                                      format: {
                                                            body: function(inner, coldex, rowdex) {
                                                                  if (inner.length <= 0) return inner;
                                                                  var el = $.parseHTML(inner);
                                                                  var result = '';
                                                                  $.each(el, function(index, item) {
                                                                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                                                                              result = result + item.lastChild.firstChild.textContent;
                                                                        } else if (item.innerText === undefined) {
                                                                              result = result + item.textContent;
                                                                        } else result = result + item.innerText;
                                                                  });
                                                                  return result;
                                                            }
                                                      }
                                                }
                                          }
                                    ]
                              }
                              , {
                                    text: '<i class="bx bx-plus me-sm-2"></i> <span class="d-none d-sm-inline-block">{{ trans('
                                    admin::users.create ') }}</span>'
                                    , className: 'btn btn-primary'
                                    , action: function() {
                                          window.location = "{{ route('dashboard.user.create') }}";
                                    }
                              }
                        ],

                  });
                  $('div.head-label').html('<h5 class="card-title mb-0">{{trans('
                        admin::users.page_title ')}}</h5>');
            }
      });