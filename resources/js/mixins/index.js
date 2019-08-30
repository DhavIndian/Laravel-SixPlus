/* VueJS Helper Function goes here */
/* Date : 07-03-2019 */

 import moment from 'moment'
 export default {

     methods: {
		 intFormat :s => parseInt(s),     	
         capitalizeFirstLetter: s => s.charAt(0).toUpperCase() + s.slice(1),
         ymdFormat: dt => moment(dt, 'MM/DD/YYYY h:mm:ss A').format('YYYY-MM-DD h:mm:ss')
     }
 }
