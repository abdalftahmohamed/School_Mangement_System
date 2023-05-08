<div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                var data =   @this.events
                var calendar = new Calendar(calendarEl, {
                    events: JSON.parse(data),
                    dateClick(info)  {
                        var title = prompt('ادخل عنوان الحدث ');
                        var date = new Date(info.dateStr + 'T00:00:00');
                        if(title != null && title != ''){
                            calendar.addEvent({
                                title: title,
                                start: date,
                                allDay: false
                            });
                            var eventAdd = {title: title,start: date};
                            @this.addevent(eventAdd);
                            // alert('تم اضافة الحدث بنجاح');
                        }else{
                            alert('من فضلك ادخل عنوان الحدث');
                        }
                    },


                    eventClick(info){
                        var title1 = confirm('هل تريد الحذف ؟ ');
                        if(title1){
                        @this.deleteEvent(info.event,info.oldEvent);
                            alert('تم الحذف بنجاح')
                        }else{
                            alert('لم يتم الحذف');
                        }

                    },





                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true, // this allows things to be dropped onto the calendar
                    drop: function(info) {
                        // is the "remove after drop" checkbox checked?
                        if (checkbox.checked) {
                            // if so, remove the element from the "Draggable Events" list
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },



                {{--eventClick:function(info){--}}
                    {{--    // console.log()--}}
                    {{--    var kn=info--}}
                    {{--    if(confirm('are sure delete this')){--}}
                    {{--        //    $('fc-event-title').on('click',function(){--}}
                    {{--        // $(this).slideUp()--}}
                    {{--        //    })--}}

                    {{--        $.ajax({--}}
                    {{--            url:'{{route("Calendar","")}}/'+info.event._def.publicId,--}}
                    {{--            type:'GET',--}}
                    {{--            dataType:'json',--}}
                    {{--            success:function(x){--}}
                    {{--                swal('good job',`has been deleted${x}`,'succesfully')--}}
                    {{--            }--}}

                    {{--        });--}}

                    {{--    }--}}
                    {{--    },--}}


                    eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                    loading: function(isLoading) {
                        if (!isLoading) {
                            // Reset custom events
                            this.getEvents().forEach(function(e){
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });

                calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });
            });


        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush



</div>
