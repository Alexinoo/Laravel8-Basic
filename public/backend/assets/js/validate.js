

 function openalert(message)  
                 {                         
                  
                    $('#dialog').html(message);

                    $('#dialog').dialog({
                        modal : true,
                        dialogClass:'vldtn_alert_dlg', 
                        buttons: [
                        {
                            text: "Close",
                            click: function() {
                            $( this ).dialog( "close" );
                            }
                        }
                        ],
                        title:'Alert',
                        open: function() {
                                $(".ui-dialog-titlebar-close")
                                .html("<span class='aaa'></span>");
                            }
                    });

          }  