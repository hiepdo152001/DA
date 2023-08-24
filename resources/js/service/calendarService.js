import AppService from "./ApiService";
const CalendarService = {

holiday(options,calendarApi,holiday) {
    Object.entries(holiday.data).forEach(([key, value]) => {
        const defaultEvent = {
          title: value.title,
          start: value.time_start,
          end: value.time_end,
          color: "#107066",
          allDay: true,
        };
        calendarApi.addEvent(defaultEvent);
        options.events = [defaultEvent];
      });
  },
  
addEvent(options,calendarApi,time){

 const data=this.getTimeCheck(time);
    const defaultEvent = {
      title: data.check,
      start: time,
      end: time,
      color: data.color,
      allDay: true,
    };

    calendarApi.addEvent(defaultEvent);
    options.events = [defaultEvent];
},

getTimeCheck(time,  color="#1dc9b7") {

  const date = new Date(time);
  const check =
    String(date.getHours()).padStart(2, "0") +
    ":" +
    String(date.getMinutes()).padStart(2, "0");
  
  if (
    (date.getHours() === 9 && date.getMinutes() >= 1) ||
    (9 < date.getHours() && date.getHours() < 17) ||
    (date.getHours() === 17 && date.getMinutes() <= 30)
  ) {
    color= "#fd3995";
  } else{
    color="#1dc9b7";
  }
    return {check,color};
},

checkView(timeIn,timeOut,check,off){
  const today = new Date().getDay();
  if (today === 6 || today === 0 ) {
    off.value = true;
  }
  if(timeIn !== null && timeOut === null){
  check.value = false;
  }
  if( timeIn !== null && timeOut !== null){
  off.value=true;
  }
   
},
Onchange(event, active) {
  if (event.target.value === "days_on" || event.target.value === "days_off") {
    active = "days_on";
  }
  if (event.target.value === "forgot_to_check") {
    active = "";
    active = "forgot_to_check";
  }
  if (event.target.value === "over_time") {
    active = "";
    active = "over_time";
  }
  if (event.target.value === "special_take_leave") {
    active = "";
    active = "special_take_leave";
  }
  if (event.target.value === "take_device_out") {
    active = "";
    active = "take_device_out";
  }
  if (event.target.value === "device_recall") {
    active = "";
    active = "device_recall";
  }
  return active;
},
};

export default CalendarService;