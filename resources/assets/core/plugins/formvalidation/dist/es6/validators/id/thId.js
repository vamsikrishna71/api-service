export default function t(t){if(t.length!==13){return{meta:{},valid:false}}let e=0;for(let a=0;a<12;a++){e+=parseInt(t.charAt(a),10)*(13-a)}return{meta:{},valid:(11-e%11)%10===parseInt(t.charAt(12),10)}}