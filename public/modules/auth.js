auth()
async function auth() {
  await fetch(`${uri}/api/auth/${window.location.search.substr(1)}`).then(res=>res.json()).then(res=>{
    if(!res.status) {
      alert(res.message)
      window.location.replace(`${uri}/login`)
    }
  })
}