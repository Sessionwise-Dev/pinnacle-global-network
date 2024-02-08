const initializeCountdown = () => {
    document.querySelectorAll('.block-countdown-timer').forEach(block => {
      const target = block.dataset.targetDate;
      if(!target) return false; 
      const target_date = new Date(target).getTime();
      //Make sure timer stops at 0
      if(target_date - new Date().getTime() < 0) return false;
      const days_tile = block.querySelector('.days-tile');
      const hours_tile = block.querySelector('.hours-tile');
      const minutes_tile = block.querySelector('.minutes-tile');
      const seconds_tile = block.querySelector('.seconds-tile');
      
      const startCountdown = () => {
        let current_date = new Date().getTime();
        let seconds_left = (target_date - current_date) / 1000;
        if(seconds_left <= 0) stopCountdown();
        let days = leadingZeroes(parseInt(seconds_left / 86400));
        seconds_left = seconds_left % 86400;
    
        let hours = leadingZeroes(parseInt(seconds_left / 3600));
        seconds_left = seconds_left % 3600;
    
        let minutes = leadingZeroes(parseInt(seconds_left / 60));
        let seconds = leadingZeroes(parseInt(seconds_left % 60));
    
        days_tile.innerHTML = days;
        hours_tile.innerHTML = hours;
        minutes_tile.innerHTML = minutes;
        seconds_tile.innerHTML = seconds;
      }
      
      const stopCountdown = () => {
        clearInterval(countdown);
        days_tile.innerHTML = '00';
        hours_tile.innerHTML = '00';
        minutes_tile.innerHTML = '00';
        seconds_tile.innerHTML = '00';
      }
      const countdown = setInterval(startCountdown, 1000);
      });
  }
  
  const leadingZeroes = n => {
    return (n < 10 ? '0' : '') + n;
  }
  
  addEventListener('DOMContentLoaded', initializeCountdown);