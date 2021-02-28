import axios from 'axios';

export const getPlaces = async (search) => {
  if (!search) return;

  const response = await axios.get(`/api/places?search=${search}`);
  return response.data;
}

export const getMarkers = async () => {
  const response = await axios.get(`/api/map/markers`);
  return response.data;
}