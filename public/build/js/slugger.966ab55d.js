(self.webpackChunk=self.webpackChunk||[]).push([[871],{854:()=>{$(document).ready((function(){"use strict";$("#name input").keyup((function(){let e=function(e){let a=[],t={а:"a",б:"b",в:"v",г:"g",д:"d",е:"e",ё:"e",ж:"zh",з:"z",и:"i",й:"y",к:"k",л:"l",м:"m",н:"n",о:"o",п:"p",р:"r",с:"s",т:"t",у:"u",ф:"f",х:"h",ц:"ts",ч:"ch",ш:"sh",щ:"shch",ы:"y",э:"e",ю:"iu",я:"ya",ь:"",ъ:""};for(let n=0;n<e.length;++n)a.push(t[e[n]]||void 0===t[e[n].toLowerCase()]&&e[n]||t[e[n].toLowerCase()].replace(/^(.)/,(function(e){return e.toUpperCase()})));return a.join("")}($("#name input").val());$("#slug input").val(e.replace(/^\s+|\s+$/g,"").toLowerCase().replace(/[^a-z0-9 -]/g,"-").replace(/\s+/g,"-").replace(/-+/g,"-").replace(/^-/,"").replace(/-$/,""))}))}))}},e=>{var a;a=854,e(e.s=a)}]);