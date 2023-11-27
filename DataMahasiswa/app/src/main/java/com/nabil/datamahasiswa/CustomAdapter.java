package com.nabil.datamahasiswa;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.nabil.datamahasiswa.Models.Data;

import java.util.List;

public class CustomAdapter extends RecyclerView.Adapter<CustomViewHolder> {
    private Context context;
    private List<Data> data;

    public CustomAdapter(Context context, List<Data> data) {
        this.context = context;
        this.data = data;
    }

    @NonNull
    @Override
    public CustomViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        return new CustomViewHolder(LayoutInflater.from(context).inflate(R.layout.list_item, parent, false));
    }

    @Override
    public void onBindViewHolder(@NonNull CustomViewHolder holder, int position) {
        holder.tvNrp.setText(data.get(position).getNrp());
        holder.tvNama.setText(data.get(position).getNama());
        holder.tvEmail.setText(data.get(position).getEmail());
        holder.tvJurusan.setText(data.get(position).getJurusan());
    }

    @Override
    public int getItemCount() {
        return data.size();
    }
}
