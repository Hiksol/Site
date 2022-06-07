const axios = require('axios');
const cheerio = require('cheerio');
const jquery = require('jquery');
const fs = require('fs');

const parse = async () => {
  const getHTML = async (url) => {
    const  { data } = await axios.get(url);
    return cheerio.load(data);
  };
  const $ = await getHTML('https://www.overclockers.ua/cpu/info/');
  console.log($.html());
  const selector = await getHTML('https://www.overclockers.ua/cpu/info/');
  selector('li').each((i,element) =>{
      const title = selector(element).find('a').text();
      const link_info =  selector(element).find('a').attr("href");
 const link =  ("https://www.overclockers.ua" + `${link_info}`);

};
module.exports(link_info)
parse();
