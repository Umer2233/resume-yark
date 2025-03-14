import store from "../store";
import { environment_api } from "../env";
export default function isAuth(to, from, next) {
  if (localStorage.getItem("token")) {
    window.location.href = environment_api.api_base_url + "contact";
  }
  return next();
}
