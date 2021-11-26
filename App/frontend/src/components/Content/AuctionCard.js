import "./Content.css";
import Card from "@mui/material/Card";
import CardActions from "@mui/material/CardActions";
import CardContent from "@mui/material/CardContent";
import CardMedia from "@mui/material/CardMedia";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";

const AuctionCard = (props) => {
  return (
    <Card sx={{ maxWidth: 400 }}>
      <CardMedia component="img" height="140" image={props.img} />
      <CardContent>
        <Typography gutterBottom variant="h5" component="div">
          {props.name}
        </Typography>
        <Typography variant="body2" color="text.secondary">
          {props.desc}
        </Typography>
      </CardContent>
      <CardActions>
        <Button size="small">otevřít</Button>
      </CardActions>
    </Card>
  );
};

export default AuctionCard;
