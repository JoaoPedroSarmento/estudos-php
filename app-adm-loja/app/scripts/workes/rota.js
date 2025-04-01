import configs from "../configs.js";
export default function rota(r){

  return `${configs.URL}app/scripts/workes${r}.worker.js`;
}