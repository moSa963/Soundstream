import{p as w,j as a,R as p,B as f,a3 as b,b as y,r as j,i as M,k as S,a9 as k,P as $,aa as x,S as B,T as u,J as H}from"./index-59b23e8a.js";const z=w(a.jsx("path",{d:"M3 4V1h2v3h3v2H5v3H3V6H0V4h3zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10h3zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2-1.43-3.2-3.2-3.2-3.2 1.43-3.2 3.2z"}),"AddAPhoto"),I=r=>{const n={};var o=0,c=null;for(let s=0;s<r.length;s+=160){const l={r:r[s],g:r[s+1],b:r[s+2],a:r[s+3]};if(!(l.a<150)){var t=Object.values(n),e=0;for(e;e<t.length;++e)if(D(l,t[e])<50){t[e].count+=1,o<=t[e].count&&(o=t[e].count,c=`rgb(${t[e].r}, ${t[e].g}, ${t[e].b})`);break}e==t.length&&(n[`${l.r}, ${l.g}, ${l.b}`]={...l,count:0})}}return c},D=(r,n)=>Math.sqrt(Math.pow(r.r-n.r,2)+Math.pow(r.g-n.g,2)+Math.pow(r.b-n.b,2)),E=({src:r,sx:n,disabled:o,onChange:c,onDominantColorLoad:t})=>{const[e,s]=p.useState(!1),l=i=>{const d=document.createElement("canvas");d.width=i.width/2,d.height=i.height/2;const h=d.getContext("2d");h.drawImage(i,0,0,d.width,d.height);const v=h.getImageData(0,0,d.width,d.height);t&&t(I(v.data))};return a.jsxs(f,{sx:{position:"relative"},onMouseEnter:()=>s(!0),onMouseLeave:()=>s(!1),children:[a.jsx(b,{src:r,sx:{...n,opacity:e&&!o?.1:1},variant:"square",onLoad:i=>l(i.target)}),e&&!o&&a.jsxs(y,{sx:{position:"absolute",inset:"0 0 0 0"},onClick:i=>i.currentTarget.children[1].click(),children:[a.jsx(z,{}),a.jsx("input",{type:"file",accept:"image/*",style:{display:"none"},onChange:i=>c&&c(i.currentTarget.files[0])}),"UPDATE"]})]})};var g={},R=M;Object.defineProperty(g,"__esModule",{value:!0});var m=g.default=void 0,V=R(j()),_=a,A=(0,V.default)((0,_.jsx)("path",{d:"M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"}),"Edit");m=g.default=A;const C=({children:r,color:n})=>{var e;const o=S.useRef(),{scroll:c}=k(),t=p.useMemo(()=>o.current?o.current.offsetHeight-50:275,[(e=o==null?void 0:o.current)==null?void 0:e.offsetHeight]);return a.jsx(f,{sx:{overflow:"hidden"},ref:o,children:a.jsx($,{sx:{width:"100%",position:"relative",py:{xs:1,sm:3,md:5},px:{xs:.5,sm:1,md:2},minHeight:300,display:"flex",flexDirection:{xs:"column",md:"row"},alignItems:"center",opacity:x(c,[0,t/3,t],[1,1,0]),transform:`translateY(${x(c,[0,t],[0,t/2])}px) scale(${x(c,[0,t/2,t],[1,1,.95])})`,background:s=>`linear-gradient(to top, ${s.palette.background.paper}, ${n||s.palette.primary.light} 110%)`},elevation:0,children:r})})},q=({description:r,title:n,type:o,avatar:c,onEdit:t,onAvatarChange:e,defColor:s,children:l})=>{const[i,d]=p.useState();return a.jsxs(C,{color:s||i,children:[a.jsx(E,{src:c,onDominantColorLoad:h=>d(h),disabled:!e,sx:{width:{xs:150,sm:220},height:{xs:150,sm:200},boxShadow:h=>h.shadows[4]},onChange:e}),a.jsxs(B,{spacing:2,sx:{overflow:"hidden",px:{xs:1,sm:5},pt:2,width:"100%"},children:[a.jsx(u,{variant:"caption",color:"gray",children:o}),a.jsx(u,{variant:"h2",noWrap:!0,sx:{fontSize:{xs:20,sm:30,md:50}},children:n}),a.jsx(u,{sx:{fontSize:{xs:10,sm:15,md:20},color:"gray",wordBreak:"break-word"},children:r}),l]}),t&&a.jsx(H,{onClick:t,sx:{position:"absolute",top:20,right:0},children:a.jsx(m,{})})]})};export{q as B};
