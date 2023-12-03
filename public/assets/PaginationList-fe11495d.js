import{e as _,g as $,ae as R,s as M,_ as g,W as U,af as v,k as j,l as B,m as E,j as b,n as N,o as A,R as u,a9 as P,c as X,B as W,d as D}from"./index-5f3032ec.js";function F(t){return String(t).match(/[\d.\-+]*\s*(.*)/)[1]||""}function K(t){return parseFloat(t)}function L(t){return _("MuiSkeleton",t)}$("MuiSkeleton",["root","text","rectangular","rounded","circular","pulse","wave","withChildren","fitContent","heightAuto"]);const T=["animation","className","component","height","style","variant","width"];let m=t=>t,x,C,k,w;const q=t=>{const{classes:e,variant:a,animation:s,hasChildren:r,width:n,height:o}=t;return A({root:["root",a,s,r&&"withChildren",r&&!n&&"fitContent",r&&!o&&"heightAuto"]},L,e)},O=R(x||(x=m`
  0% {
    opacity: 1;
  }

  50% {
    opacity: 0.4;
  }

  100% {
    opacity: 1;
  }
`)),V=R(C||(C=m`
  0% {
    transform: translateX(-100%);
  }

  50% {
    /* +0.5s of delay between each loop */
    transform: translateX(100%);
  }

  100% {
    transform: translateX(100%);
  }
`)),z=M("span",{name:"MuiSkeleton",slot:"Root",overridesResolver:(t,e)=>{const{ownerState:a}=t;return[e.root,e[a.variant],a.animation!==!1&&e[a.animation],a.hasChildren&&e.withChildren,a.hasChildren&&!a.width&&e.fitContent,a.hasChildren&&!a.height&&e.heightAuto]}})(({theme:t,ownerState:e})=>{const a=F(t.shape.borderRadius)||"px",s=K(t.shape.borderRadius);return g({display:"block",backgroundColor:t.vars?t.vars.palette.Skeleton.bg:U(t.palette.text.primary,t.palette.mode==="light"?.11:.13),height:"1.2em"},e.variant==="text"&&{marginTop:0,marginBottom:0,height:"auto",transformOrigin:"0 55%",transform:"scale(1, 0.60)",borderRadius:`${s}${a}/${Math.round(s/.6*10)/10}${a}`,"&:empty:before":{content:'"\\00a0"'}},e.variant==="circular"&&{borderRadius:"50%"},e.variant==="rounded"&&{borderRadius:(t.vars||t).shape.borderRadius},e.hasChildren&&{"& > *":{visibility:"hidden"}},e.hasChildren&&!e.width&&{maxWidth:"fit-content"},e.hasChildren&&!e.height&&{height:"auto"})},({ownerState:t})=>t.animation==="pulse"&&v(k||(k=m`
      animation: ${0} 2s ease-in-out 0.5s infinite;
    `),O),({ownerState:t,theme:e})=>t.animation==="wave"&&v(w||(w=m`
      position: relative;
      overflow: hidden;

      /* Fix bug in Safari https://bugs.webkit.org/show_bug.cgi?id=68196 */
      -webkit-mask-image: -webkit-radial-gradient(white, black);

      &::after {
        animation: ${0} 2s linear 0.5s infinite;
        background: linear-gradient(
          90deg,
          transparent,
          ${0},
          transparent
        );
        content: '';
        position: absolute;
        transform: translateX(-100%); /* Avoid flash during server-side hydration */
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
      }
    `),V,(e.vars||e).palette.action.hover)),G=j.forwardRef(function(e,a){const s=B({props:e,name:"MuiSkeleton"}),{animation:r="pulse",className:n,component:o="span",height:l,style:i,variant:c="text",width:h}=s,p=E(s,T),d=g({},s,{animation:r,component:o,variant:c,hasChildren:!!p.children}),f=q(d);return b.jsx(z,g({as:o,ref:a,className:N(f.root,n),ownerState:d},p,{style:g({width:h,height:l},i)}))}),I=G,J=({url:t,loader:e,Skeleton:a,payload:s})=>{const r=u.useRef(),[n,o]=u.useState(null),[l,i]=u.useState(null),[c,h]=u.useState(!1),{scroll:p}=P(),{setError:d}=X(),f=u.useCallback(()=>!c&&y(l,o,i,d,h,!0),[l,c]),S=u.useMemo(()=>e({list:n,next:l,setList:o,loadNext:f,payload:s}),[n,l,f,s]);return u.useEffect(()=>{o(null)},[t]),u.useEffect(()=>{n===null&&!c&&r.current.getBoundingClientRect().top<800&&y(t,o,i,d,h)},[t,d,n,c,p]),b.jsxs(W,{ref:r,children:[n!==null&&S,n===null&&a&&b.jsx(a,{})]})},y=async(t,e,a,s,r,n)=>{var o;if(t!=null){r(!0);try{const i=await(await D(t)).json();a((o=i==null?void 0:i.links)==null?void 0:o.next),e(c=>n?[...c,...i.data]:i.data)}catch(l){e(i=>i||[]),s(l)}r(!1)}};export{J as P,I as S};
