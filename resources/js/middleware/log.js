export default function log({ next, to }) {
    console.log("Hey");
    console.log(to.name);

    return next();
}